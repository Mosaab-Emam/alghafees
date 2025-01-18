import "./OurService.css";

import { staticContext } from "@/utils/contexts";
import { useContext } from "react";
import OurEvents from "../ourEvents/OurEvents";
import SectionContentBox from "../SectionContentBox";
import OurAchievementsBox from "./OurAchievementsBox";
import ServicesImages from "./ServicesImages";

export default function OurServices({ events }) {
    const static_content = useContext(staticContext);

    return (
        <section className="our-services-container md:mb-[110px] -mb-40">
            <div className="container">
                <div className="xl:h-[535px] lg:h-[404px] h-[750px]"></div>
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
            </div>
        </section>
    );
}
