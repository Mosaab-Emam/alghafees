import { BackendFile } from "@/types";
import { withColoredText } from "@/utils";
import { Head } from "@inertiajs/react";
import {
    AboutSection,
    ContactUsSection,
    Hero,
    OurClients,
    OurPartners,
    OurServices,
} from "../../components";
import { staticContext } from "../../utils/contexts";
import Layout from "../layout/Layout";

const Home = ({
    static_content,
    home_report,
    events,
}: {
    static_content: Record<string, string>;
    home_report: BackendFile;
    events: Array<Event>;
}) => {
    for (let [key, value] of Object.entries(static_content)) {
        static_content[key] = withColoredText(value.toString());
    }

    return (
        <staticContext.Provider value={static_content}>
            <Hero />
            <OurPartners />
            <AboutSection report={home_report} />
            <OurServices events={events} />
            <OurClients />
            <ContactUsSection
                position={
                    "lg:-top-[12.3rem] lg:right-0 xl:-top-[7.3rem] xl:-right-[2.5rem] 2xl:-top-[7.3rem] 2xl:right-0 top-[16.3rem] -right-[55px] "
                }
            />
        </staticContext.Provider>
    );
};

Home.layout = (page: React.ReactNode) => <Layout children={page} />;

export default Home;
