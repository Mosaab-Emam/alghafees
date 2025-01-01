import { BackendFile } from "@/types";
import {
    AboutSection,
    ContactUsSection,
    Hero,
    OurClients,
    OurPartners,
    OurServices,
} from "../../components";

function Home({ home_report }: { home_report: BackendFile }) {
    return (
        <>
            <Hero />
            <OurPartners />
            <AboutSection report={home_report} />
            <OurServices />
            <OurClients />
            <ContactUsSection
                position={
                    "lg:-top-[12.3rem] lg:right-0 xl:-top-[7.3rem] xl:-right-[2.5rem] 2xl:-top-[7.3rem] 2xl:right-0 top-[16.3rem] -right-[55px] "
                }
            />
        </>
    );
}

export default Home;
