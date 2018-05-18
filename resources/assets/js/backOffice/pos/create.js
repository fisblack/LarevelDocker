/** 
 * @author: ระบุชื่อ-นามสกุลของคุณที่นี่
 * @phone: ระบุหมายเลขโทรศัพท์ของคุณที่นี่
 * @email: ระบุอีเมลของคุณที่นี่
 */

$(document).ready(function () {
    let memberSearch = new Bloodhound({
        datumTokenizer: Bloodhound.tokenizers.obj.whitespace('name'),
        queryTokenizer: Bloodhound.tokenizers.whitespace,
        limit: 10,
        remote:   {
            url: '/api/member/all',
            ajax: {
                type: 'GET'
            }
        }
    });
    memberSearch.initialize();

    let memberTemplate = function(data) {
        return  '<div class="member-search-result">' + data.full_name + '</div>';
    }

    let typeaheadMember = $('[data-action="typeaheadMember"]')

    $(typeaheadMember).typeahead(null, {
        name: 'member-search',
        hint: true,
        display: 'full_name',
        limit: 7,
        highlight: true,
        source: memberSearch.ttAdapter(),
        templates: {
            notFound: '<div class="member-search-result">ไม่พบสมาชิกที่ต้องการ</div>',
            suggestion: memberTemplate
        }
    });

    $(typeaheadMember).on('typeahead:selected', function(event, item) {
        $('#memberID').val(item.id)
    })
});