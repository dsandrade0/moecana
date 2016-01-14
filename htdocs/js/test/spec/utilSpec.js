describe('Utils package', function() {
  var a = Utils.ip();

  it('Verifica o ip se é null ou undefined', function() {
    expect(a).not.toBe(null); 
    expect(a).not.toBeUndefined(); 
  });

  it('Verifica se é uma string', function() {
    expect(a).toEqual(jasmine.anything(String));  
  });

  it('Verifica se o IP é tipoIPV4', function() {
    expect(a.length > 7 && a.length < 15).toEqual(true)
  });

  it('Verifica se o IP é valido', function() {
    var b = a.split('.');
    var i = 0;
    for(i == 0; i < b.length; i++ ) {
      expect(parseInt(b[i]) < 254 ).toBe(true);
    }
  });
});
