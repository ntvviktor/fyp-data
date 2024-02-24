import * as fs from "fs";

export const delay = (ms) => new Promise((res) => setTimeout(res, ms));

export const write2json = (filename, data) => {
  fs.writeFile(filename, JSON.stringify(data), "utf8", (err) => {
    if (err) {
      console.log(`Error writing file: ${err}`);
    } else {
      console.log(`File is written successfully!`);
    }
  });
};
