import { Routes, Route } from "react-router-dom";
import Home from "../pages/public/Home";

export default function AppRouter() {
  return (
    <Routes>
      <Route path="/" element={<Home />} />
    </Routes>
  );
}
