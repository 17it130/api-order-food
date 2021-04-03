import mongoose, { Schema } from "mongoose";
import bcrypt from "bcrypt";
import IUser from "../interfaces/user";
import jwt from "jsonwebtoken";

const salt: number = 12;
const secret: any = process.env.JWT_SECRET;
const expired: any = process.env.JWT_EXPIRE;

const UserSchema: Schema<IUser> = new Schema(
  {
    profile_image: {
      type: String,
    },
    name: {
      type: String,
      required: true,
    },
    email: {
      type: String,
      required: true,
      unique: true,
    },
    phone: {
      type: String,
    },
    role: {
      type: String,
      enum: ["user", "shop", "admin"],
    },
    password: {
      type: String,
    },
    social_id: {
      type: String,
    },
  },
  {
    timestamps: true,
    versionKey: false,
  }
);

// * Hash the password befor it is beeing saved to the database
UserSchema.pre(
  "save",
  function (this: IUser, next: (err?: Error | undefined) => void) {
    // * Make sure you don't hash the hash
    if (!this.isModified("password")) {
      return next();
    }
    bcrypt.hash(this.password, salt, (err: Error, hash: string) => {
      if (err) return next(err);
      this.password = hash;
    });
  }
);

UserSchema.methods.comparePasswords = function (
  candidatePassword: string,
  next: (err: Error | null, same: boolean | null) => void
) {
  bcrypt.compare(candidatePassword, this.password, function (err, isMatch) {
    if (err) {
      return next(err, null);
    }
    next(null, isMatch);
  });
};

UserSchema.methods.getSignedJwtToken = function () {
  let payload: object = {
    _id: this._id,
    name: this.name,
    email: this.email,
    role: this.role,
    social_id: this.social_id,
    profile_image: this.profile_image,
  };
  return jwt.sign(payload, secret, {
    expiresIn: expired,
  });
};

export default mongoose.model<IUser>("users", UserSchema);
