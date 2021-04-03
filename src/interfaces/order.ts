import { Document, Types } from "mongoose";
import IFood from "./food";

export default interface IOrder extends Document {
  order_date: Date;
  item: Types.Array<IFood>;
  quantity: number;
  totalPrice: number;
  shop: Types.ObjectId;
  customer: Types.ObjectId;
}
