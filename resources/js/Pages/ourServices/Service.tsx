import React, { useEffect } from "react";
import { OurServices, PageTopSection } from "../../components";
import Layout from "../layout/Layout";
import OurServicesDetails from "../nestedPages/ourServicesDetails/OurServicesDetails";
import ServicesMainContent from "./ServicesMainContent";

export default function Service({ params }: { params: { serviceId: string } }) {
    useEffect(() => {
        window.scrollTo(0, 0);
    }, []);

    return (
        <Layout>
            <PageTopSection title={"خدماتنا"} description={"حلول عقارية"} />
            <OurServicesDetails id={params.serviceId} />
        </Layout>
    );
}
