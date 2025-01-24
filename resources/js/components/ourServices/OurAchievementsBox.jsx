import { staticContext } from "@/utils/contexts";
import { useContext, useEffect, useState } from "react";
import CountUp from "react-countup";
import { ourAchievementsData } from "../../data/ourServicesData";

const OurAchievementsBox = () => {
    const [isVisible, setIsVisible] = useState(false);
    const static_content = useContext(staticContext);

    function abbreviateNumber(number) {
        if (number >= 1000000000) {
            return [(number / 1000000000).toFixed(1).replace(/\.0$/, ""), "B"];
        }
        if (number >= 1000000) {
            return [(number / 1000000).toFixed(1).replace(/\.0$/, ""), "M"];
        }
        if (number >= 1000) {
            return [(number / 1000).toFixed(1).replace(/\.0$/, ""), "K"];
        }
        return [number, ""];
    }

    const data = ourAchievementsData.map((item) => {
        const [number, letter] = abbreviateNumber(
            static_content[`services_stat${item.id}_number`]
        );
        return {
            ...item,
            title: static_content[`services_stat${item.id}_text`],
            number,
            letter,
        };
    });

    useEffect(() => {
        // Create intersection observer
        const observer = new IntersectionObserver(
            (entries) => {
                entries.forEach((entry) => {
                    if (entry.isIntersecting) {
                        setIsVisible(true);
                    }
                });
            },
            { threshold: 0.1 }
        );

        // Get the element to observe
        const element = document.getElementById("achievements-section");
        if (element) {
            observer.observe(element);
        }

        return () => {
            if (element) {
                observer.unobserve(element);
            }
        };
    }, []);

    return (
        <section
            id="achievements-section"
            className="lg:w-[810px] xl:w-[910px] w-full flex flex-wrap content-center md:justify-between justify-center items-center mx-auto md:mb-[81.5px] mb-8"
        >
            {data.map((item, index) => (
                <div
                    className="w-full md:w-[30%] lg:w-[178px] flex flex-col items-center lg:gap-6 lg:flex-shrink-0 border-b-2 border-white py-8"
                    key={item?.id}
                >
                    <div
                        className={`${
                            index === 0
                                ? "w-full text-center lg:w-[126px]"
                                : index === 1
                                ? "w-full text-center lg:w-[65px] lg:text-right"
                                : "w-full text-center lg:w-[121px] lg:text-right"
                        } flex flex-col items-center gap-4`}
                    >
                        <div className="mx-auto">{item.icon}</div>
                        <div className="h-[49px] w-full lg:w-[102px] self-stretch ">
                            <h5
                                className={`flex items-center justify-center text-white text-center text-[42px] font-medium leading-[58.8px] capitalize`}
                            >
                                <span>{item.letter}</span>
                                <CountUp
                                    start={0}
                                    end={isVisible ? parseInt(item.number) : 0}
                                    duration={2.5}
                                    separator=","
                                />
                                <span>+</span>
                            </h5>
                        </div>

                        <p
                            className={`h-[18px] self-stretch text-primary-200 text-center text-base front-medium leading-[25.6px]`}
                            dangerouslySetInnerHTML={{
                                __html: item.title,
                            }}
                        />
                    </div>

                    {/* <div className="mb-[18.5px]">
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            width="178"
                            height="2"
                            viewBox="0 0 178 2"
                            fill="none"
                        >
                            <path d="M0 1L178 1.00002" stroke="#FEFFFF" />
                        </svg>
                    </div> */}
                </div>
            ))}
        </section>
    );
};

export default OurAchievementsBox;
