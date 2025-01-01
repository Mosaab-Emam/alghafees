import React from "react";
import { aboutData } from "../../data";
import AboutGoals from "../../xcomponents/aboutSection/AboutGoals";

const AboutBoxThree = () => {
    return (
        <section className="container md:mx-auto md:mb-[84.5px] mb-[50px]">
            <div className="xl:w-[1200px] lg:w-[1024px] w-full flex md:flex-row flex-col md:items-center items-start xl:gap-[178px] lg:gap-20 gap-8">
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
