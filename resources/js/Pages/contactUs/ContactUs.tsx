import Container from "@/components/Container";
import { withColoredText } from "@/utils";
import { staticContext } from "@/utils/contexts";
import { Link } from "@inertiajs/react";
import {
    Button,
    ContactUsSection,
    PageTopSection,
    SalehNameEnglishShape,
} from "../../components";
import Layout from "../layout/Layout";

const ContactUs = ({
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
            <Container>
                <section className="flex flex-col-reverse lg:flex-row-reverse md:mt-[220px] mt-[6rem] md:mb-[131px] mb-[6rem] relative">
                    <Link
                        href={static_content["cta_link"]}
                        className="lg:absolute z-50"
                    >
                        <Button
                            className={
                                "md:flex hidden w-[290px] mx-auto lg:mr-auto lg:ml-0"
                            }
                            variant="primary"
                            radius={"left"}
                        >
                            {static_content["cta_text"]}
                        </Button>
                    </Link>

                    <ContactUsSection
                        showPriceOffer={true}
                        className="md:flex hidden"
                        position={"-top-[7rem] -right-[7.5rem] "}
                    />

                    <ContactUsSection
                        showPriceOffer={false}
                        className="md:hidden flex"
                        contactUsShapeWidth="w-[330px]"
                        contactUsShapePosition="-top-[240px] -left-[2.6rem]"
                        contactUsContentPosition={"mt-[12px] -mb-10"}
                        position={"-top-[7rem] -right-[7.5rem] "}
                    />

                    <SalehNameEnglishShape
                        position={
                            "md:left-[-93px] md:top-0 -left-12 top-[8rem] z-[-1]"
                        }
                    />
                </section>
            </Container>
        </staticContext.Provider>
    );
};

ContactUs.layout = (page: React.ReactNode) => <Layout children={page} />;

export default ContactUs;
