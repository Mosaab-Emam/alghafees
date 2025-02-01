import { staticContext } from "@/utils/contexts";
import { useContext } from "react";
import { OurRealStateServicesData } from "../../../data/ourServicesData";

const OurRealStateServices = () => {
    const static_content = useContext(staticContext) as Record<string, string>;

    return (
        <section className="mb-12">
            <h4 className="head-line-h3 md:text-center text-start text-primary-600 md:mb-[50px] mb-6">
                <span
                    dangerouslySetInnerHTML={{
                        __html: static_content["services_title"],
                    }}
                />
            </h4>
            <div className="inline-flex 2xl:w-full 2xl:justify-center md:flex-row flex-col flex-wrap items-center gap-[20px]">
                {OurRealStateServicesData.map((item) => (
                    <div
                        className="w-[224px] h-[321px] flex justify-end items-start gap-[10px] rounded-[1px] bg-bg-01 p-6 section-box-shadow transition-all duration-500 ease-in-out  hover:p-[24.643px] hover:h-[329.598px] hover:w-[230px] hover:gap-[10.268px] hover:rounded-[2px] hover:border-[2.054px] hover:border-primary-600 hover:section-box-shadow-hover"
                        key={`real-state-services-${item.id}`}
                    >
                        <div className="w-[273px] flex flex-col items-start gap-[24px]">
                            <div className="w-[46.973px] h-[37.57px] flex-shrink-0">
                                {item.icon}
                            </div>
                            <h4 className="head-line-h5 text-primary-600 text-right">
                                {item.title}
                            </h4>
                            <div className="h-[144px] flex flex-col items-end gap-4 flex-shrink-0">
                                {item.service.map((subitem) => (
                                    <div
                                        key={`real-state-services-${item.id}-service-${subitem.id}`}
                                        className="flex justify-start items-center gap-2 self-stretch"
                                    >
                                        <div className="">{subitem.icon}</div>
                                        <p className="text-Gray-scale-02 regular-b1 ">
                                            {subitem.sub_title}
                                        </p>
                                    </div>
                                ))}
                            </div>
                        </div>
                    </div>
                ))}
            </div>
        </section>
    );
};

export default OurRealStateServices;
