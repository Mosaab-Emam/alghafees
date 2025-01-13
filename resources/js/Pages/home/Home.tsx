import { BackendFile, HomeStaticContent } from "@/types";
import {
    AboutSection,
    ContactUsSection,
    Hero,
    OurClients,
    OurPartners,
    OurServices,
} from "../../components";
import Layout from "../layout/Layout";

function Home({
    static_content,
    home_report,
    events,
}: {
    static_content: HomeStaticContent;
    home_report: BackendFile;
    events: Array<Event>;
}) {
    return (
        <Layout>
            <Hero static_content={static_content} />
            <OurPartners />
            <AboutSection report={home_report} />
            <OurServices events={events} />
            <OurClients />
            <ContactUsSection
                position={
                    "lg:-top-[12.3rem] lg:right-0 xl:-top-[7.3rem] xl:-right-[2.5rem] 2xl:-top-[7.3rem] 2xl:right-0 top-[16.3rem] -right-[55px] "
                }
            />
        </Layout>
    );
}

export default Home;
