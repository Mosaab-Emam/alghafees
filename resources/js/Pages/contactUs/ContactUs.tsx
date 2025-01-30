import Container from "@/components/Container";
import { Link } from "@inertiajs/react";
import {
    Button,
    ContactUsSection,
    PageTopSection,
    SalehNameEnglishShape,
} from "../../components";
import Layout from "../layout/Layout";

const ContactUs = () => {
    return (
        <>
            <PageTopSection
                title={"تواصل معنا"}
                description={"ابقَ على اتصال"}
            />
            <Container>
                <section className="flex flex-col-reverse lg:flex-row-reverse md:mt-[220px] mt-[6rem] md:mb-[131px] mb-[6rem] relative">
                    <Link href="/request-evaluation" className="lg:absolute">
                        <Button
                            className={
                                "md:flex hidden w-[290px] mx-auto lg:mr-auto lg:ml-0"
                            }
                            variant="primary"
                            radius={"left"}
                        >
                            طلب تقييم
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
        </>
    );
};

ContactUs.layout = (page: React.ReactNode) => <Layout children={page} />;

export default ContactUs;
