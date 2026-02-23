import { useEffect } from "react";
import api from "../../api/axios";

import PublicLayout from "../../layouts/PublicLayout";
import HeroSection from "../../components/HeroSection";
import LatestJobs from "../../components/LatestJobs";
import VisionMission from "../../components/VisionMission";
import Testimonials from "../../components/Testimonials";
import CommentForm from "../../components/CommentForm";

export default function Home() {

  // useEffect(() => {
  //   api.get("/ping")
  //     .then(res => console.log("API OK:", res.data))
  //     .catch(err => console.error("API ERROR:", err));
  // }, []);

  return (
    <PublicLayout>
      <HeroSection />
      <LatestJobs />
      <VisionMission />
      <Testimonials />
      <CommentForm />
    </PublicLayout>
  );
}