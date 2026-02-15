import PublicLayout from "../../layouts/PublicLayout";
import HeroSection from "../../components/HeroSection";
import LatestJobs from "../../components/LatestJobs";
import VisionMission from "../../components/VisionMission";
import Testimonials from "../../components/Testimonials";
import CommentForm from "../../components/CommentForm";

export default function Home() {
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

