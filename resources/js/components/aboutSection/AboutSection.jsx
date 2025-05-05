import Container from "../Container";
import ImageBox from "./ImageBox";
import LeftContent from "./LeftContent";
import RightContent from "./RightContent";

import GhafisShape from "../shapes/GhafisShape";
import "./AboutSection.css";

const AboutSection = ({ report }) => {
    return (
        <section className="relative">
            <Container>
                <div className="flex lg:flex-row flex-col xl:justify-evenly justify-start items-start gap-[30px] lg:gap-[20px]">
                    <RightContent />
                    <ImageBox />
                    <LeftContent report={report} />
                </div>
            </Container>
            <GhafisShape />
        </section>
    );
};

export default AboutSection;
