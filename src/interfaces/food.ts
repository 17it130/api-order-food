import { Document, Types } from "mongoose";

export default interface IFood extends Document {
  name: string;
  description: string;
  price: number;
  rating: number;
  shop: Types.ObjectId;
  images: Array<string>;
}
