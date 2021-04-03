import { Document } from "mongoose";

export default interface IUser extends Document {
  name: string;
  email: string;
  phone: string;
  profile_image: string;
  role: string;
  password: string;
  social_id: string;
  comparePasswords(
    candidatePassword: string,
    next: (err: Error | null, same: boolean | null) => void
  ): void;
}
