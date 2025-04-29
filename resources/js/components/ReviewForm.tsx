import UploadFIleInput from "@/Pages/joinUs/UploadFIleInput";
import RequestEvaluationFormInput from "@/Pages/requestEvaluation/requestEvaluationForm/RequestEvaluationFormInput";
import ReqEvluaFormSelectInput from "@/Pages/requestEvaluation/requestEvaluationForm/RequestEvaluationFormSelectInput";
import RequestEvaluationFormTextArea from "@/Pages/requestEvaluation/requestEvaluationForm/RequestEvaluationFormTextArea";
import { useForm } from "@inertiajs/react";
import { useState } from "react";
import { z } from "zod";

const ReviewForm = ({ review_token }: { review_token: string }) => {
    const [errors, setErrors] = useState<Record<string, string>>({});

    const { data, setData, post } = useForm({
        review_token,
        name: "",
        description: "",
        image: null,
        rating: "5",
        body: "",
    });

    const validate = () => {
        try {
            const schema = z.object({
                name: z.string().min(1, "اسم المقيم مطلوب"),
                description: z.string().min(1, "الوصف الوظيفي مطلوب"),
                rating: z.string().min(1, "التقييم مطلوب"),
                body: z
                    .string()
                    .min(10, "نص التقييم يجب أن يكون أطول من 10 أحرف"),
            });
            schema.parse(data);
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

    const handleSubmit = (e: React.FormEvent<HTMLFormElement>) => {
        e.preventDefault();
        if (validate()) post("/review", { forceFormData: true });
    };

    return (
        <form
            onSubmit={handleSubmit}
            className="w-[312px] md:w-full contact-us-form glass-effect-bg-primary-2 glass-effect rounded-br-[70px] rounded-tl-[70px] md:py-[50px] py-5 px-4 md:px-8"
        >
            <section className="w-full flex flex-col items-end md:items-start md:gap-[50px] gap-[48px] p-0 mb-[50px]">
                <div className="flex flex-col md:flex-row gap-8 md:gap-4 w-full">
                    <div className="flex-grow">
                        <RequestEvaluationFormInput
                            required
                            name="name"
                            type="text"
                            label="اسم المقيم"
                            placeholder="اسم المقيم"
                            value={data.name}
                            error={errors.name}
                            onChange={(
                                e: React.ChangeEvent<HTMLInputElement>
                            ) => setData("name", e.target.value)}
                        />
                    </div>
                    <div className="flex-grow">
                        <RequestEvaluationFormInput
                            required
                            name="description"
                            type="text"
                            label="الوصف الوظيفي"
                            placeholder="مثال: مدير شركة كذا"
                            value={data.description}
                            error={errors.description}
                            onChange={(
                                e: React.ChangeEvent<HTMLInputElement>
                            ) => setData("description", e.target.value)}
                        />
                    </div>
                </div>
                <div className="flex flex-col md:flex-row gap-8 md:gap-4 w-full">
                    <div className="flex-grow">
                        <UploadFIleInput
                            required
                            radius="rounded-tl-[20px] rounded-br-[20px]"
                            name="image"
                            label="صورة المقيم"
                            placeholder="اختر من الملفات"
                            value={data.image}
                            error={errors.image}
                            handleFileChange={(
                                e: React.ChangeEvent<HTMLInputElement>
                            ) =>
                                setData(
                                    "image",
                                    // @ts-ignore
                                    e.target.files![0]
                                )
                            }
                        />
                    </div>
                    <div className="flex-grow">
                        <ReqEvluaFormSelectInput
                            required
                            name="rating"
                            label="التقييم"
                            error={errors.rating}
                            placeholder="اختر التقييم"
                            value={data.rating}
                            data={[
                                { id: "1", title: "1" },
                                { id: "2", title: "2" },
                                { id: "3", title: "3" },
                                { id: "4", title: "4" },
                                { id: "5", title: "5" },
                            ]}
                            onChange={(
                                e: React.ChangeEvent<HTMLSelectElement>
                            ) => setData("rating", e.target.value)}
                        />
                    </div>
                </div>
                <div className="flex flex-col md:flex-row gap-8 md:gap-4 w-full">
                    <RequestEvaluationFormTextArea
                        required
                        name="body"
                        label="نص التقييم"
                        placeholder="نص التقييم"
                        value={data.body}
                        error={errors.body}
                        onChange={(e: React.ChangeEvent<HTMLTextAreaElement>) =>
                            setData("body", e.target.value)
                        }
                    />
                </div>
            </section>
            <div className="flex flex-col items-center gap-[50px] self-stretch ">
                <button
                    type="submit"
                    className="w-[180px] sm:h-[48px] lg:h-[46px] xl:h-[48px] mr-auto py-[15px] flex justify-center items-center bg-primary-500  text-white text-lg font-normal leading-normal transition duration-700 ease-in-out rounded-br-[50px]"
                >
                    تقديم التقييم
                </button>
            </div>
        </form>
    );
};

export default ReviewForm;
