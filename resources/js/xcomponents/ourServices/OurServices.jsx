import React from "react";

import "./OurService.css";

import Container from "../Container";
import OurEvents from "../ourEvents/OurEvents";
import SectionContentBox from "../SectionContentBox";
import OurAchievementsBox from "./OurAchievementsBox";
import ServicesImages from "./ServicesImages";

const OurServices = () => {
  return (
    <section className="our-services-container md:mb-[110px] -mb-40">
      <Container>
        <div className="container">
          <div className="xl:h-[535px] lg:h-[404px] h-[750px]"></div>
          <SectionContentBox
            sectionTitle="خدماتنا"
            textContent="استفد من خدماتنا العقارية المتميزة لدعم قراراتك الذكية"
            paragraphContent="نقدم في شركة صالح الغفيص أفضل الخدمات للمستفيدين في جميع مناطق
					المملكة."
            butWidth="w-[250px]"
            textContentWidth="w-[312px] lg:w-[400px] "
            navigateTo={"/our-services"}
          />
          <ServicesImages />
          <OurAchievementsBox />

          <OurEvents />
        </div>
      </Container>
    </section>
  );
};

export default OurServices;
