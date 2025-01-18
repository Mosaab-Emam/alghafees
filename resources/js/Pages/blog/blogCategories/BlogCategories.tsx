import { Tag } from "@/types";
import { Link } from "@inertiajs/react";
import BlogIcon from "../BlogIcon";
import CategoryIcon from "./CategoryIcon";

export default function BlogCategories({ tags }: { tags: Array<Tag> }) {
    return (
        <section
            dir="ltr"
            className="inline-flex items-center p-8 gap-[10px] rounded-tl-[50px] rounded-br-[50px] bg-bg-01 border-[3px] border-primary-300 xl:mx-auto md:mr-auto overflow-y-scroll h-96"
        >
            <div
                dir="rtl"
                className="md:w-[343px] w-[360px] flex flex-col items-start gap-8 h-full"
            >
                <div className="flex items-center gap-4 ">
                    <BlogIcon color={"#0F819F"} />
                    <h3 className=" head-line-h3 text-right text-Black-01">
                        الأوسمة
                    </h3>
                </div>

                <div
                    id="blog-categories"
                    className="flex flex-col items-start self-stretch gap-6"
                >
                    {tags.map((tag, index) => (
                        <div key={tag.id} className="w-full">
                            <Link href={`/blog?tag=${tag.slug.ar}`}>
                                <button
                                    key={tag.id}
                                    className={`${
                                        index === tags.length - 1
                                            ? ""
                                            : "border-b border-primary-200"
                                    } flex  justify-between items-center self-stretch gap-6 pb-2 w-full`}
                                >
                                    <div className="flex items-center gap-[9px]">
                                        <CategoryIcon />
                                        <h3 className="regular-b1 text-right text-primary-600">
                                            {tag.name.ar}
                                        </h3>
                                    </div>

                                    <p className=" regular-b1 text-right text-Gray-scale-02">
                                        {tag.posts_published_count} مقالات
                                    </p>
                                </button>
                            </Link>
                        </div>
                    ))}
                </div>
            </div>
        </section>
    );
}
