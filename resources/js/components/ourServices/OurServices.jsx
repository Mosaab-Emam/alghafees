import { staticContext } from "@/utils/contexts";
import { useContext } from "react";
import Container from "../Container";
import OurEvents from "../ourEvents/OurEvents";
import SectionContentBox from "../SectionContentBox";
import OurAchievementsBox from "./OurAchievementsBox";
import "./OurService.css";
import ServicesImages from "./ServicesImages";

export default function OurServices({ events }) {
    const static_content = useContext(staticContext);

    const isLargeScreen = window.innerWidth > 1580;

    return (
        <section
            className={`our-services-container my-24 ${
                isLargeScreen ? "pb-[8rem]" : "pb-[36rem]"
            }`}
        >
            <Container>
                <div
                    id="background-offset"
                    style={{ height: isLargeScreen ? "8rem" : "40rem" }}
                />
                <SectionContentBox
                    sectionTitle={static_content["services_small_top_title"]}
                    textContent={static_content["services_main_title"]}
                    paragraphContent={static_content["services_description"]}
                    butWidth="w-[250px]"
                    textContentWidth="w-[312px] lg:w-[400px] "
                    btnText={static_content["services_button_text"]}
                    navigateTo={static_content["services_button_link"]}
                />
                <ServicesImages />
                <OurAchievementsBox />

                <OurEvents events={events} />
            </Container>
        </section>
    );
}
