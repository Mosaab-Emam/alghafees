import { Post } from "@/types";
import { CalenderIcon } from "../../../assets/images/blog";
import CategoryIcon from "../../blog/blogCategories/CategoryIcon";
import BlogIcon from "../../blog/BlogIcon";

export default function BlogDetailsTitleBox({
    post,
    main_tag,
}: {
    post: Post;
    main_tag: string;
}) {
    return (
        <div className="inline-flex md:flex-row flex-col md:items-center items-start 2xl:gap-[288px] xl:gap-[255px] lg:gap-36 gap-4 mb-[28px]">
            <div className="flex items-center gap-[28px]">
                <BlogIcon color={"#0F819F"} />
                <h2 className="md:head-line-h2 head-line-h3 text-right text-Black-01">
                    {post.title.ar}
                </h2>
            </div>

            <div className="xl:w-[387px] lg:w-[350px] w-[360px] py-2 px-8 flex items-center gap-[10px] rounded-tl-[50px]  rounded-br-[50px] border-[3px] border-primary-300 bg-bg-01">
                <div className="md:w-[323px] w-[360px] flex justify-between items-start">
                    <div className="flex items-center gap-2">
                        <CategoryIcon width={"24"} height={"24"} />

                        <p className=" regular-b1 text-right text-primary-600">
                            {main_tag}
                        </p>
                    </div>
                    <div className="flex items-center gap-[9px]">
                        <CalenderIcon className="w-5 h-5" />
                        <p className=" regular-b1 text-right text-Gray-scale-02">
                            {post.published_at.slice(0, 10)}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    );
}
