import React from "react";

import HeroTextBox from "./heroTextContext/HeroTextBox";

import Container from "../Container";
import FloatSocialIcons from "../floatSocialIcons/FloatSocialIcons";
import "./Hero.css";
import ContentBox from "./heroTextContext/ContentBox";
import DownloadApp from "./heroTextContext/DownloadApp";

const Hero = () => {
  return (
    <header className="hero_section overflow-hidden ">
      <div className="hero_image_section md:h-auto h-[873px] mt-[160px]"></div>
      <Container>
        <section className="container">
          <header className="md:mt-16 mt-2">
            <div className="grid grid-cols-2 gap-8 items-center justify-center relative">
              <HeroTextBox />
              <FloatSocialIcons />
            </div>
          </header>
        </section>
      </Container>

      <div className="container md:mt-0 -mt-[225px] ">
        <ContentBox className="md:hidden flex md:mb-0 mb-[32px] w-full " />
        <DownloadApp className="md:hidden flex " />
      </div>
    </header>
  );
};

export default Hero;
