import { PageTopSection } from "../../components";
import Layout from "../layout/Layout";
import CTASection from "./components/CTASection";
import PricesSection from "./components/PricesSection";
import SectionOne from "./components/SectionOne";
import SectionTwo from "./components/SectionTwo";

const Pricing = () => (
    <>
        <PageTopSection
            title="أسعار التقييم العقاري"
            description="أسعار التقييم العقاري"
        />
        <SectionOne />
        <SectionTwo />
        <PricesSection />
        <CTASection />
    </>
);

Pricing.layout = (page: React.ReactNode) => <Layout children={page} />;

export default Pricing;
