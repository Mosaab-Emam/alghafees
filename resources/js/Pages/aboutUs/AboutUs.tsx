import { OurValues, PageTopSection, ReportsSection } from "../../components";
import { BackendFile } from "../../types";
import AboutBoxOne from "./AboutBoxOne";
import AboutBoxTwo from "./AboutBoxTwo";

import { withColoredText } from "@/utils";
import { staticContext } from "@/utils/contexts";
import Layout from "../layout/Layout";
import "./AboutUs.css";

type AboutUsProps = {
    static_content: Record<string, string>;
    reports: Array<BackendFile>;
    evaluations: Array<BackendFile>;
};

const AboutUs = ({ static_content, reports, evaluations }: AboutUsProps) => {
    for (let [key, value] of Object.entries(static_content)) {
        static_content[key] = withColoredText(value.toString());
    }

    return (
        <staticContext.Provider value={static_content}>
            <PageTopSection
                title={static_content["small_top_title"]}
                description={static_content["main_top_title"]}
            />
            <AboutBoxOne />
            <AboutBoxTwo />

            <OurValues />
            <ReportsSection reports={reports} evaluations={evaluations} />
        </staticContext.Provider>
    );
};

AboutUs.layout = (page: React.ReactNode) => <Layout children={page} />;

export default AboutUs;
