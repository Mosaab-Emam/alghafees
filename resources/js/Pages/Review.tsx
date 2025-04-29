import Container from "@/components/Container";
import {
    ContactUsShape,
    PageTopSection,
    SalehNameEnglishShape,
} from "../components";
import ReviewForm from "../components/ReviewForm";
import BgGlassFilterShape from "../components/shapes/BgGlassFilterShape";
import OurClientsShape from "../components/shapes/OurClientsShape";
import Layout from "./layout/Layout";

const Review = ({ review_token }: { review_token: string }) => {
    return (
        <>
            <PageTopSection title={"تقييم"} description={"قم بتقييم الخدمة"} />
            <Container>
                <section className="flex flex-col lg:flex-row md:mt-[220px] mt-[6rem] md:mb-[131px] mb-[6rem] relative">
                    <div className="relative lg:mb-8 mb-[56px]">
                        <OurClientsShape position="-top-[7rem] -right-[7.5rem]" />
                        <Container>
                            <div className="flex lg:flex-row flex-col 2xl:justify-evenly items-center gap-8 lg:gap-[135px] relative">
                                <ReviewForm review_token={review_token} />

                                <BgGlassFilterShape
                                    position={"-right-[11rem] -bottom-[8rem]"}
                                />
                            </div>
                        </Container>
                    </div>

                    <ContactUsShape />

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

Review.layout = (page: React.ReactNode) => <Layout children={page} />;

export default Review;
