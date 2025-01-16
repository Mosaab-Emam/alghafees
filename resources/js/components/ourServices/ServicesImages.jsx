import { Link } from "@inertiajs/react";
import { ourServicesData } from "../../data";
import Button from "../button/Button";
import ParagraphContent from "../ParagraphContent";

const ServicesImages = () => {
    return (
        <div className="flex md:flex-row flex-col justify-start 2xl:justify-center items-center md:mb-28 mb-8">
            {ourServicesData?.map((item, index) => (
                <div
                    key={item?.id}
                    className="flip-card md:w-[300px] w-full h-[532px] perspective-1000"
                >
                    <div className="relative w-full h-full transition-transform duration-1000 transform-style-3d hover:rotate-y-180">
                        {/* Front Card */}
                        <div className="absolute w-full h-full backface-hidden">
                            <div
                                style={{
                                    background: ` linear-gradient(0deg, rgba(0, 0, 0, 0.2), rgba(0, 0, 0, 0.2)),
                    linear-gradient(180deg, rgba(9, 75, 93, 0) 0%, #08495A 100%),
                    url(${item?.front_image}) lightgray 50% / cover no-repeat`,
                                }}
                                className="w-full h-full rounded-sm flex justify-center items-end gap-[10px] py-[24px] px-[29px]"
                            >
                                <div className="flex flex-col items-start gap-[33px] flex-shrink-0 w-[234px]">
                                    <div className="flex flex-col items-center gap-[8px] w-[20px]">
                                        <h2 className="self-stretch text-bg-01 text-center  head-line-h5 ">
                                            {`0${index + 1}`}
                                        </h2>
                                        <svg
                                            xmlns="http://www.w3.org/2000/svg"
                                            width="1"
                                            height="157"
                                            viewBox="0 0 1 157"
                                            fill="none"
                                        >
                                            <path
                                                d="M0.5 0.5V157"
                                                stroke="#FEFFFF"
                                            />
                                        </svg>
                                    </div>
                                    <h3 className="self-stretch text-bg-01 text-center text-[22px] font-normal leading-[30.8px]">
                                        {item.title}
                                    </h3>
                                </div>
                            </div>
                        </div>

                        {/* Back Card */}
                        <div className="absolute w-full h-full backface-hidden rotate-y-180">
                            <div
                                style={{
                                    background: `linear-gradient(0deg, rgba(38, 41, 42, 0.95) 0%, rgba(38, 41, 42, 0.95) 100%),  
                    			url(${item?.back_image}) lightgray 50% / cover no-repeat`,
                                }}
                                className="w-full h-full rounded-sm flex justify-center items-center gap-[10px] py-[24px] px-[29px]"
                            >
                                <div className="flex flex-col items-center justify-center gap-[33px] w-[241px]">
                                    <div className="flex flex-col justify-center items-center gap-[8px] w-[20px]">
                                        <h2 className="self-stretch text-bg-01 text-center  head-line-h5">
                                            {`0${index + 1}`}
                                        </h2>
                                    </div>
                                    <h3 className="self-stretch text-bg-01 text-center text-[22px] font-normal leading-[30.8px]">
                                        {item.title}
                                    </h3>
                                    <ParagraphContent
                                        width="w-[400px]"
                                        textDirection="text-center"
                                        textColor="text-primary-200"
                                    >
                                        {item.description}
                                    </ParagraphContent>
                                    <Link href={`/our-services/${item?.id}`}>
                                        <Button>المزيد</Button>
                                    </Link>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            ))}
        </div>
    );
};

export default ServicesImages;
