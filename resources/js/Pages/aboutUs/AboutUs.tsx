import { OurValues, PageTopSection, ReportsSection } from "../../components";
import { BackendFile } from "../../types";
import AboutBoxOne from "./AboutBoxOne";
import AboutBoxTwo from "./AboutBoxTwo";

import { withColoredText } from "@/utils";
import { staticContext } from "@/utils/contexts";
import { useContext } from "react";
import Layout from "../layout/Layout";
import "./AboutUs.css";

type AboutUsProps = {
    reports: Array<BackendFile>;
    evaluations: Array<BackendFile>;
};

const AboutUs = ({ reports, evaluations }: AboutUsProps) => {
    const static_content = useContext<Record<string, string>>(staticContext);

    return (
        <>
            <PageTopSection
                title={static_content["small_top_title"]}
                description={static_content["main_top_title"]}
            />
            <AboutBoxOne />
            <AboutBoxTwo />

            <OurValues />
            <ReportsSection reports={reports} evaluations={evaluations} />
        </>
    );
};

AboutUs.layout = (page: React.ReactNode) => <Layout children={page} />;

export default AboutUs;
