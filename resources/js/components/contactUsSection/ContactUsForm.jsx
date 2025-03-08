import { contactUsFormSchema } from "@/schemas";
import { staticContext } from "@/utils/contexts";
import { useContext, useRef, useState } from "react";
import InputGroup from "./InputGroup";

const ContactUsForm = () => {
    const static_content = useContext(staticContext);
    const nameRef = useRef(null);
    const emailRef = useRef(null);
    const phoneRef = useRef(null);
    const inquiryRef = useRef(null);
    const [errors, setErrors] = useState({});

    const handleSubmit = (e) => {
        e.preventDefault();

        const formData = {
            name: nameRef.current.value,
            email: emailRef.current.value,
            phone: phoneRef.current.value,
            inquiry: inquiryRef.current.value,
        };

        try {
            const validatedData = contactUsFormSchema.parse(formData);
            setErrors({});

            const emailBody = `
// الرجاء عدم تعديل محتويات هذا البريد الإلكتروني
// Please do not modify the contents of this email
------------------------------------------------

الاسم: ${validatedData.name}
البريد الالكتروني: ${validatedData.email}
رقم الجوال: ${validatedData.phone}
الاستفسار: ${validatedData.inquiry}
            `.trim();

            const mailtoUrl = `mailto:taqeem@alghafestaqeem.com?subject=استفسار&body=${encodeURIComponent(
                emailBody
            )}`;
            window.location.href = mailtoUrl;
        } catch (error) {
            const formattedErrors = {};
            error.errors.forEach((err) => {
                formattedErrors[err.path[0]] = err.message;
            });
            setErrors(formattedErrors);
        }
    };

    return (
        <form
            onSubmit={handleSubmit}
            className="md:w-[512px] w-[312px] contact-us-form glass-effect-bg-primary-2  glass-effect rounded-br-[70px] rounded-tl-[70px] md:py-[50px] py-5  pr-4 md:pr-[50px] "
        >
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
                    <div className="w-full">
                        <InputGroup placeholder={"الاسم"} _ref={nameRef} />
                        {errors.name && (
                            <p className="text-red-500 text-sm text-right mt-1">
                                {errors.name}
                            </p>
                        )}
                    </div>
                    <div className="w-full">
                        <InputGroup
                            type="email"
                            placeholder={"البريد الالكتروني"}
                            _ref={emailRef}
                        />
                        {errors.email && (
                            <p className="text-red-500 text-sm text-right mt-1">
                                {errors.email}
                            </p>
                        )}
                    </div>
                    <div className="w-full">
                        <InputGroup
                            type="text-area"
                            placeholder={"الاستفسار"}
                            _ref={inquiryRef}
                        />
                        {errors.inquiry && (
                            <p className="text-red-500 text-sm text-right mt-1">
                                {errors.inquiry}
                            </p>
                        )}
                    </div>
                </div>
            </section>
            <div className="flex flex-col items-center gap-[50px] self-stretch ">
                <div className="w-full">
                    <InputGroup
                        type="tel"
                        placeholder={"رقم الجوال"}
                        _ref={phoneRef}
                    />
                    {errors.phone && (
                        <p className="text-red-500 text-sm text-right mt-1">
                            {errors.phone}
                        </p>
                    )}
                </div>
                <button className="w-[180px] sm:h-[48px] lg:h-[46px] xl:h-[48px] mr-auto py-[15px] flex justify-center items-center bg-primary-500  text-white text-lg font-normal leading-normal transition duration-700 ease-in-out rounded-br-[50px]">
                    ارسال
                </button>
            </div>
        </form>
    );
};

export default ContactUsForm;
