import { BackendFile } from "@/types";
import {
    AboutSection,
    ContactUsSection,
    Hero,
    OurClients,
    OurPartners,
    OurServices,
} from "../../components";
import Layout from "../layout/Layout";

type Props = {
    home_report: BackendFile;
    events: Array<Event>;
    reviews: Array<{
        name: string;
        description: string;
        image: string;
        rating: number;
        body: string;
    }>;
};

const Home = ({ home_report, events, reviews }: Props) => {
    return (
        <>
            <Hero />
            <OurPartners />
            <AboutSection report={home_report} />
            <OurServices events={events} />
            <OurClients reviews={reviews} />
            <ContactUsSection
                position={
                    "lg:-top-[12.3rem] lg:right-0 xl:-top-[7.3rem] xl:-right-[2.5rem] 2xl:-top-[7.3rem] 2xl:right-0 top-[16.3rem] -right-[55px] "
                }
            />
        </>
    );
};

Home.layout = (page: React.ReactNode) => <Layout children={page} />;

export default Home;
