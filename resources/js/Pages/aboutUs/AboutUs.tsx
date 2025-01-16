import { useEffect } from "react";
import { OurValues, PageTopSection, ReportsSection } from "../../components";
import { BackendFile } from "../../types";
import AboutBoxOne from "./AboutBoxOne";
import AboutBoxTwo from "./AboutBoxTwo";

import Layout from "../layout/Layout";
import "./AboutUs.css";

type AboutUsProps = {
    reports: Array<BackendFile>;
    evaluations: Array<BackendFile>;
};

const AboutUs = ({ reports, evaluations }: AboutUsProps) => {
    useEffect(() => {
        window.scrollTo(0, 0);
    }, []);

    return (
        <>
            <PageTopSection title={"من نحن"} description={"خبرة موثوقة"} />
            <AboutBoxOne />
            <AboutBoxTwo />

            <OurValues />
            <ReportsSection reports={reports} evaluations={evaluations} />
        </>
    );
};

AboutUs.layout = (page: React.ReactNode) => <Layout children={page} />;

export default AboutUs;
