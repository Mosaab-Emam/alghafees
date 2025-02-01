import { staticContext } from "@/utils/contexts";
import { useContext } from "react";
import AboutGoals from "../../components/aboutSection/AboutGoals";
import { aboutData } from "../../data";

const AboutBoxThree = () => {
    const static_content = useContext(staticContext) as Record<string, string>;
    aboutData.map((item: any) => {
        item["title"] = static_content[`feat${item.id}_title`];
        item["desc"] = static_content[`feat${item.id}_description`];
    });

    return (
        <section className="md:mx-auto md:mb-[84.5px] mb-[50px]">
            <div className="xl:w-[1200px] lg:w-[1024px] w-full flex flex-wrap lg:flex-nowrap md:flex-row flex-col md:items-center items-start lg:justify-between gap-8 lg:gap-0">
                {aboutData.map((item, index) => (
                    <AboutGoals
                        type="about-page"
                        index={index}
                        key={item.id}
                        img={item.img}
                        title={item.title}
                        desc={item.desc}
                    />
                ))}
            </div>
        </section>
    );
};

export default AboutBoxThree;
