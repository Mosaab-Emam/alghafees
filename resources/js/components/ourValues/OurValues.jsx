import { SvgLogoAbout } from "../../assets/images/about";
import AboutBoxThree from "../../Pages/aboutUs/AboutBoxThree";
import Container from "../Container";
import AboutUsBuildingBgBox from "./AboutUsBuildingBgBox";
import "./OurValues.css";
import OurVisionBox from "./OurVisionBox";
import ValuesBox from "./ValuesBox";

const OurValues = () => {
    return (
        <section className="relative ">
            <Container>
                <div className="xl:w-[1222px] lg:w-[1024px] w-full xl:h-[601px] lg:h-[630px] h-auto">
                    <div className="w-full xl:h-full h-[382px] absolute md:-top-24 top-[-134px] our-values-bg" />
                    <section className="relative z-10 ">
                        <AboutBoxThree />
                        <section className="flex lg:flex-row flex-col justify-center lg:items-end items-center lg:gap-[141.24px] relative">
                            <span className="our-values-bg-span lg:absolute lg:top-[3rem] lg:left-1/2 lg:-translate-x-1/2">
                                <SvgLogoAbout />
                            </span>

                            <div className="lg:flex lg:relative lg:-top-[3rem]">
                                <AboutUsBuildingBgBox />
                                <OurVisionBox />
                                <ValuesBox />
                            </div>
                        </section>
                    </section>
                </div>
            </Container>
        </section>
    );
};

export default OurValues;
