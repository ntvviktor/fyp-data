import puppeteer from "puppeteer-core";
import { customAlphabet, nanoid } from "nanoid";
import write2CSV from "./toCSV.js";
import { delay, write2json } from "./utils.js";

const customerNanoID = customAlphabet("0123456789abcde");

const AUTH = "brd-customer-hl_d5e3d0ef-zone-scraping_browser1:3mjs2kh5wahc";
const SBR_WS_ENDPOINT = `wss://${AUTH}@brd.superproxy.io:9222`;

async function run() {
  console.log("Connecting to Scraping Browser...");
  const browser = await puppeteer.connect({
    browserWSEndpoint: SBR_WS_ENDPOINT,
  });
  try {
    console.log("Connected! Navigating...");
    const page = await browser.newPage();

    await page.goto(
      "https://www.amazon.sg/gp/bestsellers/books/ref=zg_bs_nav_books_0",
      { timeout: 2 * 60 * 1000 }
    );
    const client = await page.createCDPSession();
    const response = await client.send("Captcha.solve", {
      detectTimeout: 30 * 1000,
    });

    if (typeof response === "object" && response !== null) {
      const status = response.status;
      console.log(`Captcha solve status: ${status}`);
    } else {
      console.log("No response from CAPTCHA solver");
    }

    const bestSellers = await page.evaluate(() => {
      const items = [];
      const elements = document.querySelectorAll(
        ".zg-grid-general-faceout .p13n-sc-uncoverable-faceout"
      );

      for (const element of elements) {
        const nameElement = element.querySelector(
          ".a-link-normal > span > div"
        );
        const priceElement = element.querySelector(
          ".a-size-base.a-color-price"
        );
        const urlElement = element.querySelector(".a-link-normal");

        const name = nameElement ? nameElement?.innerText.trim() : null;
        const price = priceElement ? priceElement.innerText.trim() : null;
        const url = urlElement
          ? "https://www.amazon.sg" + urlElement.getAttribute("href")
          : null;

        items.push({
          name: name,
          price: price,
          url: url,
        });
      }
      return items;
    });
    // Generate IDs in Node context
    const enhancedBestSellers = bestSellers.map((item) => ({
      id: nanoid(), // Generate ID here
      ...item,
    }));

    write2CSV("products.csv", enhancedBestSellers);
    const customers = await getCustomerReview(enhancedBestSellers, page);
    write2CSV("customers.csv", customers);
    write2json("products.json", enhancedBestSellers);
    write2json("customers.json", customers);
    return;
  } catch (e) {
    console.log(e);
  } finally {
    await browser.close();
  }
}

async function getCustomerReview(bestSellers, page) {
  let enhancedCustomersData = [];

  for (const product of bestSellers) {
    try {
      await page.goto(product.url, { timeout: 2 * 60 * 1000 });
      const productID = product.id;
      console.log(product.url);
      // Extract data from all customer reviews
      const customersData = await page.evaluate(() => {
        const reviewElements = document.querySelectorAll(
          ".a-row.a-spacing-none"
        ); // Selector for all review elements
        const customers = [];

        reviewElements.forEach((reviewElement) => {
          const nameElement = reviewElement.querySelector(".a-profile-name");
          const ratingElement = reviewElement.querySelector(".a-icon-alt");
          const profileUrlElement = reviewElement.querySelector(".a-profile");

          const customerName = nameElement
            ? nameElement.innerText.trim()
            : null;
          let rating = ratingElement ? ratingElement.innerText.trim() : null;
          const profileUrl = profileUrlElement
            ? "https://www.amazon.com" + profileUrlElement.getAttribute("href")
            : null;

          let rate = null;
          if (rating != null) {
            rate = parseFloat(rating.substring(0, 3));
          }
          customers.push({
            name: customerName,
            profileUrl: profileUrl,
            rating: rate,
          });
        });
        return customers;
      });

      enhancedCustomersData.push(
        ...customersData.map((customer) => ({
          id: customerNanoID(10),
          productID: productID,
          ...customer,
        }))
      );
      await delay(2000);
    } catch (e) {
      console.log(e);
      return [];
    }
  }
  return enhancedCustomersData;
}

run();
