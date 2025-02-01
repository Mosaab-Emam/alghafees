import { staticContext } from "@/utils/contexts";
import { useContext } from "react";
import InputGroup from "./InputGroup";

const ContactUsForm = () => {
    const static_content = useContext(staticContext);

    return (
        <form className="md:w-[512px] w-[312px] contact-us-form glass-effect-bg-primary-2  glass-effect rounded-br-[70px] rounded-tl-[70px] md:py-[50px] py-5  pr-4 md:pr-[50px] ">
            <div className="md:mb-[56px] md:w-full w-[312px] mb-[48px] md:pl-0 pl-4">
                <h5
                    className=" head-line-h5 text-right text-Gray-scale-02 mb-2"
                    dangerouslySetInnerHTML={{
                        __html:
                            static_content["contact_us_form_title"] ||
                            static_content["form_title"],
                    }}
                />
                <p
                    className="regular-b1 text-right text-Gray-scale-02 "
                    dangerouslySetInnerHTML={{
                        __html:
                            static_content["contact_us_form_description"] ||
                            static_content["form_description"],
                    }}
                />
            </div>

            <section className="w-full flex flex-col items-end md:gap-[50px] gap-[48px] p-0 mb-[50px]">
                <div className="w-full flex flex-col items-end md:gap-[50px] gap-[48px]">
                    <InputGroup placeholder={"الاسم"} />
                    <InputGroup
                        type="email"
                        placeholder={"البريد الالكتروني"}
                    />
                    <InputGroup type="text-area" placeholder={"الاستفسار"} />
                </div>
            </section>
            <div className="flex flex-col items-center gap-[50px] self-stretch ">
                <InputGroup type="tel" placeholder={"رقم الجوال"} />
                <button className="w-[180px] sm:h-[48px] lg:h-[46px] xl:h-[48px] mr-auto py-[15px] flex justify-center items-center bg-primary-500  text-white text-lg font-normal leading-normal transition duration-700 ease-in-out rounded-br-[50px]">
                    ارسال
                </button>
            </div>
        </form>
    );
};

export default ContactUsForm;
