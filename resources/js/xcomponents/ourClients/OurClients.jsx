import React from "react";

import Container from "../Container";
import TextContentBox from "./TextContentBox";
import SliderBox from "./sliderBox/SliderBox";

const OurClients = () => {
  return (
    <section className="relative lg:mb-[140px]  mb-8">
      <Container>
        <section className="container">
          <div className="flex md:flex-row flex-col  md:gap-0 gap-8 justify-between md:items-center items-start  ">
            <TextContentBox />
            <SliderBox />
          </div>
        </section>
      </Container>
    </section>
  );
};

export default OurClients;
