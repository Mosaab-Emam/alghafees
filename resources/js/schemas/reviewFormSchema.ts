import { z } from "zod";

export const reviewFormSchema = z.object({
    name: z.string().min(2, "الاسم يجب أن يحتوي على حرفين على الأقل"),
    description: z.string().min(2, "الوصف يجب أن يحتوي على حرفين على الأقل"),
    rating: z.number().min(1, "التقييم يجب أن يكون على الأقل 1"),
    body: z.string().min(10, "المحتوى يجب أن يحتوي على 10 أحرف على الأقل"),
});
