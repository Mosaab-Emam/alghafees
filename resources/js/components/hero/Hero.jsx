import HeroTextBox from "./heroTextContext/HeroTextBox";

import FloatSocialIcons from "../floatSocialIcons/FloatSocialIcons";
import "./Hero.css";
import ContentBox from "./heroTextContext/ContentBox";
import DownloadApp from "./heroTextContext/DownloadApp";

export default function Hero() {
    return (
        <header className="hero_section overflow-hidden ">
            <div className="hero_image_section md:h-auto h-[873px]">
                <section className="container px-4 md:px-8">
                    <header className="md:mt-16">
                        <div className="flex lg:grid items-center lg:grid-cols-2 justify-between lg:justify-center lg:gap-8 relative">
                            <HeroTextBox />
                            <FloatSocialIcons />
                        </div>
                    </header>
                </section>
            </div>

            <div className="container md:mt-0 -mt-[225px] ">
                <ContentBox className="md:hidden flex md:mb-0 mb-[32px] w-full " />
                <DownloadApp className="md:hidden flex " />
            </div>
        </header>
    );
}
