import { nanoid, customAlphabet } from "nanoid";

var NanoID = () => {
  return nanoid();
};

for (let i = 0; i < 4; i++) {
  const id = NanoID();
  console.log(id);

  const customNanoID = customAlphabet("1234567890", 10);
  const customerID = customNanoID(); //=> "4f90d13a42"
  console.log(customerID);
}
