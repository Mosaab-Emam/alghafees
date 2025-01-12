import React, { useEffect } from "react";
import { Outlet } from "react-router-dom";
import { PageTopSection } from "../../components";
import Layout from "../layout/Layout";
import ServicesMainContent from "./ServicesMainContent";

const OurServices = () => {
    useEffect(() => {
        window.scrollTo(0, 0);
    }, []);

    return (
        <Layout>
            <PageTopSection title={"خدماتنا"} description={"حلول عقارية"} />
            <ServicesMainContent />
        </Layout>
    );
};

export default OurServices;
