import { Parser } from "@json2csv/plainjs";
import fs from "fs";

export default function write2CSV(filepath, data) {
  try {
    const parser = new Parser();
    const csv = parser.parse(data);

    if (fs.existsSync(filepath)) {
      let date = new Date();
      filepath =
        filepath.substring(0, filepath.length - 4) + `${date.toString()}.csv`;
    }
    fs.writeFile(filepath, csv, (err) => {
      if (err) {
        console.log(err);
        return;
      }
    });
  } catch (err) {
    console.error(err);
  }
}
