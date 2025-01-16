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
            <section className="container md:mt-[220px] mt-[6rem] md:mb-[131px] mb-[6rem] relative">
                <Button
                    onClick={() =>
                        (window.location.href = "/request-evaluation")
                    }
                    className={"md:flex hidden mt-[100px] w-[290px] mr-auto"}
                    variant="primary"
                    radius={"left"}
                >
                    طلب تقييم{" "}
                </Button>

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
        </>
    );
};

ContactUs.layout = (page: React.ReactNode) => <Layout children={page} />;

export default ContactUs;
