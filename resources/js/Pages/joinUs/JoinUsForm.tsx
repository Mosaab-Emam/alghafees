import { joinUsFormSchema } from "@/schemas";
import { staticContext } from "@/utils/contexts";
import { useContext, useRef, useState } from "react";
import { z } from "zod";
import Button from "../../components/button/Button";
import FormInput from "./FormInput";
import SelectInput from "./SelectInput";
import TextArea from "./TextArea";

// Define the validation schema

type FormData = z.infer<typeof joinUsFormSchema>;
type FormErrors = Partial<Record<keyof FormData, string>>;

const JoinUsForm = () => {
    const static_content = useContext(staticContext) as Record<string, string>;
    const firstNameRef = useRef<HTMLInputElement>(null);
    const lastNameRef = useRef<HTMLInputElement>(null);
    const emailRef = useRef<HTMLInputElement>(null);
    const phoneRef = useRef<HTMLInputElement>(null);
    const roleRef = useRef<HTMLSelectElement>(null);
    const personalDescriptionRef = useRef<HTMLTextAreaElement>(null);
    const [errors, setErrors] = useState<FormErrors>({});

    const validateForm = () => {
        const formData = {
            firstName: firstNameRef.current?.value || "",
            lastName: lastNameRef.current?.value || "",
            email: emailRef.current?.value || "",
            phone: phoneRef.current?.value || "",
            role: roleRef.current?.value || "",
            personalDescription: personalDescriptionRef.current?.value || "",
        };

        try {
            joinUsFormSchema.parse(formData);
            setErrors({});
            return true;
        } catch (error) {
            if (error instanceof z.ZodError) {
                const formattedErrors: FormErrors = {};
                error.errors.forEach((err) => {
                    if (err.path[0]) {
                        const field = err.path[0].toString();
                        formattedErrors[field as keyof FormData] = err.message;
                    }
                });
                setErrors(formattedErrors);
            }
            return false;
        }
    };

    const handleSubmit = (e: React.FormEvent) => {
        e.preventDefault();

        if (!validateForm()) {
            return;
        }

        const isConfirmed = window.confirm(
            "سيتم فتح برنامج البريد الخاص بك. تأكد من إرفاق سيرتك الذاتية قبل الإرسال."
        );

        if (!isConfirmed) {
            return;
        }

        const firstName = firstNameRef.current?.value;
        const lastName = lastNameRef.current?.value;
        const email = emailRef.current?.value;
        const phone = phoneRef.current?.value;
        const role = roleRef.current?.value;
        const personalDescription = personalDescriptionRef.current?.value;

        const emailBody = `
// الرجاء عدم تعديل محتويات هذا البريد الإلكتروني
// Please do not modify the contents of this email
------------------------------------------------

الاسم الأول: ${firstName}
الاسم الأخير: ${lastName}
البريد الالكتروني: ${email}
رقم الجوال: ${phone}
نوع الوظيفة: ${role}
نبذة شخصية: ${personalDescription}
        `.trim();

        const mailtoUrl = `mailto:taqeem@alghafestaqeem.com?subject=${encodeURIComponent(
            "طلب إنضمام"
        )}&body=${encodeURIComponent(emailBody)}`;
        window.location.href = mailtoUrl;
    };

    return (
        <section className="absolute w-full 2xl:left-[16.3rem] xl:left-[10rem] lg:left-[2rem] left-0 xl:top-[-8rem] lg:top-[-8rem] top-[38rem] z-10 flex justify-end">
            {" "}
            <form
                onSubmit={handleSubmit}
                className="xl:w-[590px] lg:w-[540px] w-4/5 ml-[10%] lg:ml-0 md:min-h-[1121px] min-h-auto flex flex-col item-center  rounded-br-[50px] rounded-tl-[50px] p-8 border-[2px] border-primary-600 bg-bg-01 "
            >
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
                        name="firstName"
                        placeholder="ادخل اسمك الاول هنا"
                        ref={firstNameRef}
                        error={errors.firstName}
                    />
                    <FormInput
                        type="text"
                        label="الاسم الاخير"
                        name="lastName"
                        placeholder="ادخل اسمك الاخير هنا"
                        ref={lastNameRef}
                        error={errors.lastName}
                    />
                    <FormInput
                        type="email"
                        label="البريد الالكتروني"
                        name="email"
                        placeholder="ادخل بريدك الالكتروني"
                        ref={emailRef}
                        error={errors.email}
                    />
                    <FormInput
                        type="tel"
                        label="رقم الجوال"
                        name="phonNumber"
                        placeholder="ادخل رقم جوالك"
                        ref={phoneRef}
                        error={errors.phone}
                    />
                    <SelectInput
                        name="role"
                        label="نوع الوظيفة"
                        ref={roleRef}
                        error={errors.role}
                    />
                    <TextArea
                        label="نبذة شخصية"
                        name="personalDescription"
                        placeholder="اكتب نبذة شخصية عنك"
                        ref={personalDescriptionRef}
                        error={errors.personalDescription}
                    />

                    <Button
                        className={"xl:w-[526px] lg:w-full w-full mt-[40px]"}
                        type="submit"
                    >
                        {static_content["form_btn_text"]}
                    </Button>
                </section>
            </form>
        </section>
    );
};

export default JoinUsForm;
