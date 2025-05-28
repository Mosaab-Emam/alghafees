import { staticContext } from "@/utils/contexts";
import { useContext } from "react";
import { PageTopSection } from "../../components";
import Layout from "../layout/Layout";
import CTASection from "./components/CTASection";
import PricesSection from "./components/PricesSection";
import SectionOne from "./components/SectionOne";
import SectionTwo from "./components/SectionTwo";

const Pricing = () => {
    const static_content = useContext<Record<string, string>>(staticContext);

    return (
        <>
            <PageTopSection
                title={static_content["small_top_title"]}
                description={static_content["main_top_title"]}
            />
            <SectionOne />
            <SectionTwo />
            <PricesSection />
            <CTASection />
        </>
    );
};

Pricing.layout = (page: React.ReactNode) => <Layout children={page} />;

export default Pricing;
