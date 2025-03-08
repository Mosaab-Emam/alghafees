import FormInput from "./FormInput";
import SelectInput from "./SelectInput";
import TextArea from "./TextArea";
import UploadFIleInput from "./UploadFIleInput";

import { staticContext } from "@/utils/contexts";
import { useContext } from "react";
import Button from "../../components/button/Button";

const JoinUsForm = () => {
    const static_content = useContext(staticContext) as Record<string, string>;

    return (
        <section className="absolute w-full 2xl:left-[16.3rem] xl:left-[10rem] lg:left-[2rem] left-0 xl:top-[-8rem] lg:top-[-8rem] top-[38rem] z-10 flex justify-end">
            {" "}
            <form className="xl:w-[590px] lg:w-[540px] w-4/5 ml-[10%] lg:ml-0 md:min-h-[1121px] min-h-auto flex flex-col item-center  rounded-br-[50px] rounded-tl-[50px] p-8 border-[2px] border-primary-600 bg-bg-01 ">
                <div className="xl:w-[526px] lg:w-[445px] w-full flex flex-col items-start gap-6 mb-[33px]">
                    <div className="flex flex-col flex-start gap-2">
                        <h5
                            className=" head-line-h5 text-right  text-Gray-scale-02 mb-2"
                            dangerouslySetInnerHTML={{
                                __html: static_content["form_title"],
                            }}
                        />
                        <p
                            className="regular-b1 text-right  text-Gray-scale-02 "
                            dangerouslySetInnerHTML={{
                                __html: static_content["form_description"],
                            }}
                        />
                    </div>
                    <svg
                        className="md:w-[305px] w-full "
                        xmlns="http://www.w3.org/2000/svg"
                        height="1"
                        viewBox="0 0 305 1"
                        fill="none"
                    >
                        <path
                            d="M304 0.5H1"
                            stroke="#CFE6EC"
                            strokeLinecap="round"
                        />
                    </svg>
                </div>

                <section className="flex flex-col items-start gap-[33px] self-stretch">
                    <FormInput
                        type="text"
                        label="الاسم الاول"
                        name={"firstName"}
                        placeholder="ادخل اسمك الاول هنا"
                    />
                    <FormInput
                        type="text"
                        label="الاسم الاخير"
                        name={"lastName"}
                        placeholder="ادخل اسمك الاخير هنا"
                    />
                    <FormInput
                        type="email"
                        label="البريد الالكتروني"
                        name={"email"}
                        placeholder="ادخل بريدك الالكتروني"
                    />
                    <FormInput
                        type="tel"
                        label="رقم الجوال"
                        name={"phonNumber"}
                        placeholder="ادخل رقم جوالك"
                    />
                    <SelectInput />
                    <TextArea
                        label="نبذة شخصية"
                        name={"personalDescription"}
                        placeholder="اكتب نبذة شخصية عنك"
                    />

                    <UploadFIleInput
                        label="السيرة الذاتيه"
                        name={"resume"}
                        placeholder=" ارفع سيرتك الذاتية "
                        handleFileChange={() => {}}
                    />

                    <Button
                        className={"xl:w-[526px] lg:w-full w-full mt-[40px]"}
                    >
                        {static_content["form_btn_text"]}
                    </Button>
                </section>
            </form>
        </section>
    );
};

export default JoinUsForm;
