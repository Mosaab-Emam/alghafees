import RequestEvaluationFormInput from "@/Pages/requestEvaluation/requestEvaluationForm/RequestEvaluationFormInput";
import ReqEvluaFormSelectInput from "@/Pages/requestEvaluation/requestEvaluationForm/RequestEvaluationFormSelectInput";
import { trainingApplicationFormSchema } from "@/schemas/trainingApplicationFormSchema";
import { staticContext } from "@/utils/contexts";
import { useForm, usePage } from "@inertiajs/react";
import { useContext, useState } from "react";
import { z } from "zod";
import Button from "../../../components/button/Button";
import UploadFileInput from "../UploadFIleInput";

// Define the validation schema

type FormData = z.infer<typeof trainingApplicationFormSchema>;
type FormErrors = Partial<Record<keyof FormData, string>>;

export default function TraineeApplicationForm() {
    const static_content = useContext(staticContext) as Record<string, string>;
    const props = usePage().props;
    const training_types = props.training_types as Array<{
        id: number;
        name: string;
    }>;
    const [errors, setErrors] = useState<FormErrors>({});

    const { data, setData, post } = useForm({
        trainingType: "",
        cv_file: null,
        university_name: "",
        training_period: "",
        starting_date: "",
        phone_number: "",
    });

    const validateForm = () => {
        try {
            trainingApplicationFormSchema.parse(data);
            setErrors({});
            return true;
        } catch (error: any) {
            if (error.errors) {
                const errors: Record<string, string> = {};
                error.errors.forEach((err: any) => {
                    if (err.path && err.path.length > 0) {
                        errors[err.path[0]] = err.message;
                    }
                });
                setErrors(errors);
            }
            return false;
        }
    };

    const handleSubmit = (e: React.FormEvent) => {
        e.preventDefault();
        if (validateForm())
            post("/join-us/trainee-application", { forceFormData: true });
    };

    return (
        <section className="absolute w-full 2xl:left-[16.3rem] xl:left-[10rem] lg:left-[2rem] left-0 xl:top-[-8rem] lg:top-[-8rem] top-[38rem] z-10 flex justify-end">
            {" "}
            <form
                onSubmit={handleSubmit}
                className="xl:w-[590px] lg:w-[540px] w-4/5 ml-[10%] lg:ml-0 flex flex-col item-center rounded-br-[50px] rounded-tl-[50px] p-8 border-[2px] border-primary-600 bg-bg-01 "
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
                    <ReqEvluaFormSelectInput
                        required
                        name="trainingType"
                        label="نوع التدريب"
                        error={errors.trainingType}
                        placeholder="اختر نوع التدريب"
                        value={data.trainingType}
                        data={training_types.map((type) => ({
                            id: type.id.toString(),
                            title: type.name,
                        }))}
                        onChange={(e: React.ChangeEvent<HTMLSelectElement>) =>
                            setData("trainingType", e.target.value)
                        }
                    />
                    <UploadFileInput
                        required
                        radius="rounded-tl-[20px] rounded-br-[20px]"
                        name="cv_file"
                        label="السيرة الذاتية"
                        placeholder="اختر من الملفات"
                        value={data.cv_file}
                        error={errors.cv_file}
                        handleFileChange={(
                            e: React.ChangeEvent<HTMLInputElement>
                        ) =>
                            setData(
                                "cv_file",
                                // @ts-ignore
                                e.target.files![0]
                            )
                        }
                    />
                    <RequestEvaluationFormInput
                        required
                        name="university_name"
                        type="text"
                        label="اسم الجامعة"
                        placeholder="مثال: جامعة الملك عبد العزيز"
                        value={data.university_name}
                        error={errors.university_name}
                        onChange={(e: React.ChangeEvent<HTMLInputElement>) =>
                            setData("university_name", e.target.value)
                        }
                    />
                    <RequestEvaluationFormInput
                        required
                        name="training_period"
                        type="text"
                        label="مدة التدريب"
                        placeholder="مثال: 3 أشهر"
                        value={data.training_period}
                        error={errors.training_period}
                        onChange={(e: React.ChangeEvent<HTMLInputElement>) =>
                            setData("training_period", e.target.value)
                        }
                    />
                    <RequestEvaluationFormInput
                        required
                        name="starting_date"
                        type="text"
                        label="تاريخ بداية التدريب"
                        placeholder="مثال: 2025-01-01"
                        value={data.starting_date}
                        error={errors.starting_date}
                        onChange={(e: React.ChangeEvent<HTMLInputElement>) =>
                            setData("starting_date", e.target.value)
                        }
                    />
                    <RequestEvaluationFormInput
                        required
                        name="phone_number"
                        type="text"
                        label="رقم الجوال"
                        placeholder="مثال: 0539455519"
                        value={data.phone_number}
                        error={errors.phone_number}
                        onChange={(e: React.ChangeEvent<HTMLInputElement>) =>
                            setData("phone_number", e.target.value)
                        }
                    />
                    <Button
                        className={"xl:w-[526px] lg:w-full w-full"}
                        type="submit"
                    >
                        {static_content["form_btn_text"]}
                    </Button>
                </section>
            </form>
        </section>
    );
}
