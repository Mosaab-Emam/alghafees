import { staticContext } from "@/utils/contexts";
import { useContext } from "react";
import { AboutMainImg } from "../../assets/images/about";
import SectionQuotes from "../SectionQuotes";

const ImageBox = ({ imgHeight = "h-[332px] lg:h-[704px] xl:h-[674px]" }) => {
    const static_content = useContext(staticContext);

    return (
        <section className="relative self-end md:self-center lg:self-end md:mb-8 lg:mb-0 ">
            <SectionQuotes className="absolute md:-translate-x-1/2 md:left-1/2 left-[-6%] md:-top-12 lg:top-0 -top-2 ">
                <span
                    dangerouslySetInnerHTML={{
                        __html: static_content["about_big_top_title"],
                    }}
                />
            </SectionQuotes>
            <div className="relative w-[234px] md:w-[380px] xl:w-[468px] ">
                <img
                    className={`w-full ${imgHeight}`}
                    src={AboutMainImg}
                    alt="about-main-img"
                    loading="lazy"
                />
                <div className="bg-vision-img glass-effect"></div>
            </div>
        </section>
    );
};

export default ImageBox;
