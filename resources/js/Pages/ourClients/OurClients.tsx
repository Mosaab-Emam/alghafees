import { OurPartners, PageTopSection } from "../../components";
import Layout from "../layout/Layout";
import ClientsBoxOne from "./ClientsBoxOne";
import ClientsBoxTwo from "./ourClientsSlider/ClientsBoxTwo";
import OurClientsSlider from "./ourClientsSlider/OurClientsSlider";

const OurClients = () => (
    <>
        <PageTopSection title={"عملاؤنا"} description={"ثقة عملائنا"} />
        <section className="container md:mt-[211px] mt-[6rem]">
            <ClientsBoxOne />
            <OurClientsSlider />
            <ClientsBoxTwo />
        </section>
        <OurPartners className="pt-8 pb-12" />
    </>
);

OurClients.layout = (page: React.ReactNode) => <Layout children={page} />;

export default OurClients;
