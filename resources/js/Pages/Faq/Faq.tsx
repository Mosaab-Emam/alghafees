import Container from "@/components/Container";
import PageTopSection from "@/components/pageTopSection/PageTopSection";
import { staticContext } from "@/utils/contexts";
import { useContext } from "react";
import Layout from "../layout/Layout";

const Faq = () => {
    const static_content = useContext<Record<string, string>>(staticContext);

    return (
        <>
            <PageTopSection
                title={static_content["small_top_title"]}
                description={static_content["main_top_title"]}
            />
            <Container>
                <section className="md:mt-[211px] mt-[6rem] md:mb-0 mb-12 relative">
                    hello
                </section>
            </Container>
        </>
    );
};

Faq.layout = (page: React.ReactNode) => <Layout>{page}</Layout>;

export default Faq;
