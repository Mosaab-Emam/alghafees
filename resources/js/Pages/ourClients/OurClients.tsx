import Container from "@/components/Container";
import { withColoredText } from "@/utils";
import { staticContext } from "@/utils/contexts";
import { OurPartners, PageTopSection } from "../../components";
import Layout from "../layout/Layout";
import ClientsBoxOne from "./ClientsBoxOne";
import ClientsBoxTwo from "./ourClientsSlider/ClientsBoxTwo";
import OurClientsSlider from "./ourClientsSlider/OurClientsSlider";

const OurClients = ({
    static_content,
}: {
    static_content: Record<string, string>;
}) => {
    for (let [key, value] of Object.entries(static_content)) {
        static_content[key] = withColoredText(value.toString());
    }

    return (
        <staticContext.Provider value={static_content}>
            <PageTopSection
                title={static_content["small_top_title"]}
                description={static_content["main_top_title"]}
            />
            <section className="md:mt-[211px] mt-[6rem]">
                <Container>
                    <ClientsBoxOne />
                    <OurClientsSlider />
                    <ClientsBoxTwo />
                </Container>
            </section>
            <OurPartners className="pt-8 pb-12" />
        </staticContext.Provider>
    );
};

OurClients.layout = (page: React.ReactNode) => <Layout children={page} />;

export default OurClients;
