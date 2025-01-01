import React from "react";

import ImageBox from "./ImageBox";
import LeftContent from "./LeftContent";
import RightContent from "./RightContent";

import Container from "../Container";
import GhafisShape from "../shapes/GhafisShape";
import "./AboutSection.css";

const AboutSection = () => {
  return (
    <section className="relative md:mb-[110px] -mb-20 ">
      <Container>
        <section className="container">
          <div className="flex md:flex-row flex-col xl:justify-evenly justify-start items-start gap-[30px] lg:gap-[20px]">
            <RightContent />
            <ImageBox />
            <LeftContent />
          </div>
        </section>
      </Container>
      <GhafisShape />
    </section>
  );
};

export default AboutSection;
