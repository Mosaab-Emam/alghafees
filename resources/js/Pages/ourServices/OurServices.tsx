import { staticContext } from "@/utils/contexts";
import { useContext } from "react";
import { PageTopSection } from "../../components";
import Layout from "../layout/Layout";
import ServicesMainContent from "./ServicesMainContent";

const OurServices = () => {
    const static_content = useContext<Record<string, string>>(staticContext);

    return (
        <>
            <PageTopSection
                title={static_content["small_top_title"]}
                description={static_content["main_top_title"]}
            />
            <ServicesMainContent />
        </>
    );
};

OurServices.layout = (page: React.ReactNode) => <Layout children={page} />;

export default OurServices;
