import { useEffect } from "react";
import { PageTopSection } from "../../components";
import Layout from "../layout/Layout";
import ServicesMainContent from "./ServicesMainContent";

const OurServices = () => {
    useEffect(() => {
        window.scrollTo(0, 0);
    }, []);

    return (
        <>
            <PageTopSection title={"خدماتنا"} description={"حلول عقارية"} />
            <ServicesMainContent />
        </>
    );
};

OurServices.layout = (page: React.ReactNode) => <Layout children={page} />;

export default OurServices;
