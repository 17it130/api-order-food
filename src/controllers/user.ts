import { NextFunction, Request, Response } from "express";
import User from "../models/user";

const register = async (req: Request, res: Response, next: NextFunction) => {
  let { name, email, password } = req.body;

  const checkExistedUser = await User.findOne({ email });

  if (checkExistedUser) {
    return res.json({
      status: 0,
      message: "User already existed!",
    });
  }

  const user = new User({
    name,
    email,
    password,
  });

  return res.json({
    status: 1,
    user: user,
  });
};

export default { register };
