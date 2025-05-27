import Container from "@/components/Container";
import PageTopSection from "@/components/pageTopSection/PageTopSection";
import { staticContext } from "@/utils/contexts";
import { useContext, useEffect } from "react";
import Layout from "../layout/Layout";

const Faq = () => {
    const static_content = useContext<Record<string, string>>(staticContext);

    useEffect(() => {
        const h2_titles = document.querySelectorAll("h2");
        h2_titles.forEach((title) => {
            title.classList.add("head-line-h2");
        });

        const h3_titles = document.querySelectorAll("h3");
        h3_titles.forEach((title) => {
            title.classList.add("head-line-h3");
        });
    }, []);

    return (
        <>
            <PageTopSection
                title={static_content["small_top_title"]}
                description={static_content["main_top_title"]}
            />
            <Container>
                <section className="md:mt-[211px] mt-[6rem] md:mb-0 mb-12 relative">
                    <div
                        dangerouslySetInnerHTML={{
                            __html: static_content["content"],
                        }}
                    />
                </section>
            </Container>
        </>
    );
};

Faq.layout = (page: React.ReactNode) => <Layout>{page}</Layout>;

export default Faq;
